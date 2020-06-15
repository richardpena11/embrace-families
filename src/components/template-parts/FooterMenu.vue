<template>
  <nav>
    
    {{ menu }}

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
        v-if="item.children.length > 0"
        class="dropdown-menu"
      >
        <span >{{item.content}}</span>
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
  name: 'footer',
  props: {
    name: {
      type: String,
      required: true
    }
  },

  data() {
    return {
      site: this.$store.state.site
    }
  },

  computed: {
    logo() {
      if (this.site.logo) {
        return this.$store.getters.singleById({ type: 'media', id: this.site.logo })
      }
    },

    menu(){
      return this.$store.getters.menu({ name: this.name })
    }
  }
}
</script>

<style scoped>
  nav{
    display: flex;
    top: 10rem;
  }

  .item-menu{
    display: flex;
    align-items: center;
  }

  .item-menu > a{
    height: 100%;
    padding: 0 1rem;
    line-height: 6rem;
    color: #000;
    text-decoration: none;
  }

  .dropdown-menu{
    display: none;
    z-index: 1000;
    position: absolute;
    top: 6rem;
    width: 15rem;
    padding: 1rem 2rem;
    background: #ccc;
    transition: all 1s;
    flex-direction: column;
  }

  .dropdown-menu > span{
    font-size: 1.25rem;
    padding: .5rem 0;
    text-transform: uppercase;
    font-weight: 700;
  }

  .dropdown-menu > a{
    padding: .5rem 0;
    color: #000;
    text-decoration: none;
  }

  .item-menu:hover .dropdown-menu{
    display: flex;
  }

  a[title="highlighted_button"]{
    padding: 0 3rem;
    margin-left: 2rem;
    background: #777777;
  }
  
</style>
