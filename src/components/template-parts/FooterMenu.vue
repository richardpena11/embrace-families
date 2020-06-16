<template>
  <nav class="footer__nav">

    <div
      class="item-menu"
      v-for="item in menu.footer.children"
      :key="item.id"
    >
      <a
        :href="item.url"
        :target="item.target"
        :title="item.title"
        v-html="item.content"
      ></a>
    </div>

    <div
      class="item-menu footer__extra"
    >
      <a
        :href="menu.footer.extra.url"
        :target="menu.footer.extra.target"
        :title="menu.footer.extra.title"
        v-html="menu.footer.extra.content"
      ></a>
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

    this.menu.nav = oldMenu.filter(el => el.content === 'Main')[0]
    this.menu.footer = oldMenu.filter(el => el.content === 'Footer')[0]
    this.menu.footer.extra = oldMenu.filter(el => el.title === 'footer-extra')[0]

    this.menu.nav.children = oldMenu.filter(el => el.parent == this.menu.nav.id)
    this.menu.footer.children = oldMenu.filter(el => el.parent == this.menu.footer.id)

    for(const subitem of this.menu.nav.children){
      subitem.children = oldMenu.filter(el => el.parent == subitem.id)
    }

    console.log(this.menu)
  },
}
</script>

<style scoped>
  nav{
    display: flex;
    top: 10rem;
  }

  .footer__nav{
    display: flex;
    flex-wrap: wrap;
    width: 60%;
    justify-content: space-around;
    padding-right: 10rem;
    margin: 0 auto;
  }

  .item-menu{
    display: flex;
    align-items: center;
  }

  .item-menu > a{
    height: 100%;
    padding: 0 1rem;
    line-height: 4rem;
    color: #000;
    text-decoration: none;
  }

  .footer__extra{
    position: absolute;
    right: 5rem;
    margin-top: 1.5rem;
  }
  
</style>
