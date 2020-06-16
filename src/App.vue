<template> 

  <div 
    id="vue-wordpress-app"
    @click="handleClicks"
  >

    <div
      class="site-branding"
    >
      <img
        v-if="logo"
        class="logo"
        :src="logo.source_url"
        :alt="logo.alt_text"
        @click="$router.push('/')"
      />
      <span @click="$router.push('/')">{{ site.name }}</span>
      <nav-menu
        class="main-menu" 
        name="main"
      />
    </div>

    <transition
      name="fade"
      mode="out-in"
      @after-leave="updateScroll"
    >
      <router-view class="routerView" :key="$route.path" />
    </transition>

    <transition name="fade">
      <site-loading v-if="loading" />
    </transition>

    <footer class="footer">
      <img
        v-if="logo"
        class="logo"
        :src="logo.source_url"
        :alt="logo.alt_text"
      />

      <footer-menu
        class="footer-menu" 
        name="main"
      />
    </footer>

  </div>
</template>

<script>
import NavMenu from '@/components/template-parts/NavMenu'
import FooterMenu from '@/components/template-parts/FooterMenu'
import SiteLoading from '@/components/utility/SiteLoading'

export default {
  components: {
    NavMenu,
    FooterMenu,
    SiteLoading
  },
  data() {
    return {
      site: this.$store.state.site
    }
  },
  computed: {
    loading() {
      return this.$store.state.site.loading
    },
    logo() {
      if (this.site.logo) {
        return this.$store.getters.singleById({ type: 'media', id: this.site.logo })
      }
    }
  },
  methods: {
    getLinkEl(el) {
      while (el.parentNode) {
        if (el.tagName === 'A') return el
        el = el.parentNode
      }
    },
    handleClicks (e) {
      const a = this.getLinkEl(e.target)
      if (a && a.href.includes(this.site.url)) {
        const { altKey, ctrlKey, metaKey, shiftKey, button, defaultPrevented } = e
        // don't handle if has class 'no-router'
        if (a.className.includes('no-router')) return
        // don't handle with control keys
        if (metaKey || altKey || ctrlKey || shiftKey) return
        // don't handle when preventDefault called
        if (defaultPrevented) return
        // don't handle right clicks
        if (button !== undefined && button !== 0) return
        // don't handle if `target="_blank"`
        if (a.target && a.target.includes('_blank')) return
        // don't handle same page links
        let currentURL = new URL(a.href, window.location.href)
        if (currentURL && currentURL.pathname === window.location.pathname) {
          // if same page link has same hash prevent default reload
          if (currentURL.hash === window.location.hash) e.preventDefault()
          return
        }
        // Prevent default and push to vue-router
        e.preventDefault()
        let path = a.href.replace(this.site.url, '')
        this.$router.push(path)
      }
    },
    updateScroll() {
      window.scroll(0,0)
    }
  }
}
</script>

<style>

:root{
  --main-color: #092735;
  --main-color-darker: #061d27;
  --main-color-lighter: #0c3548;
  --secondary-color: #7f9cae;
  --secondary-color-darker: #5c7e93;
  --secondary-color-lighter: #9fb4c2;
  --secondary-color-bg: #d8e1e6;
}

body{
  font-family: 'Lato', Arial;
  overflow-x: hidden;
}

.container{
  width: 90%;
  max-width: 1400px;
  padding: 0;
  padding-top: 2rem;
}

.site-branding {
  position: fixed;
  z-index: 2000;
  display: flex;
  height: 6rem;
  width: 100vw;
  flex-direction: row;
  align-content: center;
  background: var(--main-color-lighter);
  cursor: pointer
}

.logo {
  display: inline-block;
  vertical-align: middle;
  height: 4.8rem;
  width: auto;
  margin: auto .8rem;
}

.site-branding>span {
  vertical-align: middle;
  font-size: 2.4rem;
  line-height: 6rem;
  font-weight: bold;
  color: #fff;
}

.main-menu {
  width: 100%;
  display: flex;
  flex-flow: row wrap;
  justify-content: flex-end;
}

.routerView{
  padding-top: 6rem;
}

.footer{
  display: flex;
  background: var(--secondary-color-bg);
  padding: 3rem 0;
}

/* Vue transition classes
-------------------------------------------- */

.fade-enter-active {
  transition: opacity .4s cubic-bezier(.4,0,0,1);
}

.fade-leave-active {
  transition: opacity .2s cubic-bezier(.4,0,0,1);
}

.fade-enter-to,
.fade-leave {
  opacity: 1;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

</style>