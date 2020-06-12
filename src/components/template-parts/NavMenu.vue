<template>
  <nav>

    <div
      class="item-menu"
      v-for="item in menu"
      :key="item.id"
    >
      <a
        :href="item.url"
        :target="item.target"
        :title="item.title"
        v-html="item.content"
      ></a>
      
      <div 
        class="dropdown-menu"
      >
        <span v-if="item.children.length > 0">{{item.content}}</span>
        <a
          v-for="dropdownItem in item.children"
          :key="dropdownItem.id"
          :href="dropdownItem.url"
          :target="dropdownItem.target"
          :title="dropdownItem.title"
          v-html="dropdownItem.content"
        ></a>
      </div>
    </div>

  </nav>
</template>

<script>
export default {
  name: 'NavMenu',
  props: {
    name: {
      type: String,
      required: true
    }
  },

  data() {
    return {
      site: this.$store.state.site,
      menu: [],
    }
  },

  computed: {
    logo() {
      if (this.site.logo) {
        return this.$store.getters.singleById({ type: 'media', id: this.site.logo })
      }
    }
  },

  created(){
    const oldMenu = this.$store.getters.menu({ name: this.name });

    this.menu = oldMenu.filter(el => el.parent === '0')

    console.log(oldMenu)

    for (const item of this.menu){
      item.children = oldMenu.filter(el => el.parent == item.id)
    }
  }
}
</script>

<style scoped>
  nav{
    display: flex;
  }

  .item-menu > a{
    padding: 2rem 1rem;
    color: #000;
    text-decoration: none;
  }

  .dropdown-menu{
    display: none;
    z-index: 1000;
    position: absolute;
    width: 15rem;
    background: #ccc;
    transition: all 1s;
    flex-direction: column;
  }

  .item-menu:hover .dropdown-menu{
    display: flex;
  }
</style>
