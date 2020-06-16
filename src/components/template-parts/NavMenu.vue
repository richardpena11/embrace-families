<template>
  <nav v-if="navResponsive">

    <div
      class="item-menu"
      v-for="item in menu.nav.children"
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

  <nav v-else-if="!navResponsive">

    <div class="nav-burger" @click="openMenu">
      <svg viewBox="0 0 100 80" width="40" height="40">
        <rect width="100" height="20"></rect>
        <rect y="30" width="100" height="20"></rect>
        <rect y="60" width="100" height="20"></rect>
      </svg>
    </div>

    <div class="nav-mobile">

      <div
      class="nav-mobile__item"
        v-for="item in menu.nav.children"
        :key="item.id"
      >
        <a
          @click="openDropdown($event)"
          :href="item.children.length > 0 ? '#': item.url"
          :target="item.target"
          :title="item.title"
          v-html="item.content"
        ></a>
        
        <div 
          v-if="item.children.length > 0"
          class="nav-mobile__dropdown-menu dropdown-menu"
        >
          
          <a :href="item.url" >{{item.content}}</a>
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
      navResponsive: null,
      menuOpened: false,
    }
  },

  computed: {
    logo() {
      if (this.site.logo) {
        return this.$store.getters.singleById({ type: 'media', id: this.site.logo })
      }
    }
  },

  methods: {
    getWindowWidth(){
      this.navResponsive = window.innerWidth <= 830 ? false : true
    },

    openMenu(){
      const navMobile = document.querySelector('.nav-mobile')

      if(this.menuOpened){
        navMobile.style.width = '0'
        this.menuOpened = false
      } else{
        navMobile.style.width = '50vw'
        this.menuOpened = true
      }

    },

    openDropdown(e){
      const el = e.target.nextElementSibling

      if(el){
        
        if(el.id){
          el.style.display = 'none'
          el.style.height = '0'
          el.id = ''
        } else{
          el.style.display = 'flex'
          el.style.height = 'initial'
          el.id = "opened"
        }

      }
    }
  },

  created(){
    const oldMenu = this.$store.getters.menu({ name: this.name });

    this.menu.nav = oldMenu.filter(el => el.content === 'Main')[0]
    this.menu.footer = oldMenu.filter(el => el.content === 'Footer')[0]

    this.menu.nav.children = oldMenu.filter(el => el.parent == this.menu.nav.id)
    this.menu.footer.children = oldMenu.filter(el => el.parent == this.menu.footer.id)

    for(const subitem of this.menu.nav.children){
      subitem.children = oldMenu.filter(el => el.parent == subitem.id)
    }

    this.getWindowWidth()

    window.addEventListener('resize', this.getWindowWidth)
  },

  destroyed(){
    window.addEventListener('resize', this.getWindowWidth)
  }
}
</script>

<style scoped>
  nav{
    display: flex;
    top: 10rem;
  }

  .item-menu{
    padding-left: 1.5rem;
    padding-right: 1.5rem;
    display: flex;
    align-items: center;
  }

  .item-menu:last-child{
    margin-left: 1rem;
  }

  .item-menu:hover{
    background: var(--main-color);
  }

  .item-menu:last-child:hover{
    background: var(--main-color);
  }

  .item-menu > a{
    height: 100%;
    line-height: 6rem;
    color: #fff;
    text-decoration: none;
  }

  .dropdown-menu{
    display: none;
    z-index: 1000;
    position: absolute;
    top: 6rem;
    width: 15rem;
    padding: 1rem 2rem;
    background: var(--secondary-color-lighter);
    transition: all 1s;
    flex-direction: column;
  }

  .dropdown-menu > span{
    color: #000;
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
    background: var(--main-color-darker);
  }

  .nav-burger > svg{
    width: 3rem;
    height: 3rem;
    fill: #fff;
  }

  .nav-burger{
    width: 10rem;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 2000;
  }

  .nav-mobile{
    position: fixed;
    z-index: 2000;
    height: 100vh;
    width: 0vw;
    top: 6rem;
    background: var(--main-color);
    display: flex;
    flex-direction: column;
    transition: width 500ms;
  }

  .nav-mobile__item > a{
    color: #fff;
    text-decoration: none;
    display: inline-block;
    padding: 2rem 4rem;
    width: 80%;
  }

  .nav-mobile__item > svg{
    fill: #fff;
    width: 1.5rem;
    height: 1.2rem;
  }

  .nav-mobile__item > path{
    fill: #fff;
  }
  .nav-mobile a[title="highlighted_button"]{
    margin-left: 0;
  }

  .nav-mobile__dropdown-menu{
    height: 0;
    padding-left: 5rem;
    position: initial;
    width: 100%;
    background: var(--main-color-lighter);
    color: #fff;
    transition: height 1s;
  }

  .nav-mobile__dropdown-menu > a{
    color: #fff;
  }
  
</style>
