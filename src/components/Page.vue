<template>
  <main>
    <div v-if="page">
      <div v-html="page.content.rendered"></div>
    </div>
  </main>
</template>

<script>

export default {
  name: 'Page',
  props: {
    slug: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      request: {
        type: 'pages',
        slug: this.slug,
        showLoading: true 
      }
    }
  },
  computed: {
    page() {
      return this.$store.getters.singleBySlug(this.request)
    }
  },
  methods: {
    getPage () {
        this.$store.dispatch('getSingleBySlug', this.request).then(() => {
          if (this.page) {
            this.$store.dispatch('updateDocTitle', { parts: [ this.page.title.rendered, this.$store.state.site.name] })
          } else {
            this.$router.replace('/404')
          }
        })
      }
  },
  created () {
    this.getPage()
  }
}
</script>

<style>

  .header{
    background: var(--secondary-color-bg);
    padding-bottom: 8rem;
  }

  .header__btn{
    padding: 2rem 3rem;
  }

  .header__btn > a{
    padding: .7rem 1.5rem;
    font-size: 1.4rem;
    border: 1px solid #000 !important;
  }

  .header__btn > a:hover{
    background: var(--main-color);
    color: #fff;
  }

  .header__content{
    margin-top: 3rem;
  }

  .header__content__title{
    margin-bottom: 2.5rem;
  }
  
  .header__content__title h2{
    font-size: 4rem;
    line-height: 5rem;
    font-family: 'Lato', Arial;
    font-weight: 400;
    margin: 0;
  }

  .header__content__subtitle p{
    margin: 1rem 0;
    line-height: 2rem;
    font-size: 2rem;
  }

  .posts{
    padding: 5rem 0;
  }

  .posts > div{
    display: flex;
    flex-direction: row;
    justify-content: space-around;
  }

  .posts .wp-show-posts{
    width: 50%;
  }

  .posts .wp-show-posts-single{
    display: flex;
    flex-direction: column;
    height: 100%;
    width: 70%;
    margin: 0 auto;
    border: none;
  }

  .posts .wp-show-posts:last-child{
    border-left: 2px solid #ccc;
  }

  .posts .wp-show-posts-entry-title > a{
    font-size: 2.5rem;
    line-height: 3.5rem;
    font-family: 'Lato', Arial;
    font-weight: 400;
  }

  .posts .wp-show-posts-entry-summary > p{
    font-family: 'Lato', Arial;
    font-weight: 400;
    text-align: justify;
  }

  .posts .wpsp-read-more{
    text-align: center;
    margin-top: auto;
  }

  .posts .wpsp-read-more > a{
    bottom: 0;
    padding: .7rem 1.5rem;
    font-size: 1.4rem;
    border: 1px solid #000 !important;
  }

  .single-post__btn > a:hover{
    background: var(--main-color);
    color: #fff;
  }

  .key{
    background: var(--secondary-color-bg);
    padding: 2rem 0;
  }

  .key > div{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
  }

  .key__title{
    font-size: 2.5rem;
    line-height: 3.5rem;
    font-family: 'Lato', Arial;
    font-weight: 400;
  }

  .key__title--new{
    margin-bottom: 1rem;
  }

  .key__resource{
    width: 55%;
    max-width: 60rem;
  }

  .key__resource__li{
    margin: 0;
    padding: 1rem 0;
    border-bottom: 1px solid #ccc;
    font-size: 2rem;
  }

  .key__resource__li--last{
    border: none;
  }

  .key__new{
    width: 40%;
    max-width: 47rem;
  }

  .wp-show-posts-inner{
    width: 100%;
  }

  .wp-post-image{
    width: 100%;
    max-width: 40rem;
  }

  .involved__content .wp-show-posts-single{
    margin-top: 0;
  }

  .wp-show-posts-entry-header{
    display: flex;
    flex-direction: column-reverse;
    margin-bottom: 1rem;
  }

  .wp-show-posts-posted-on > a{
    text-decoration: none;
  }

  .wp-show-posts-entry-date{
    font-family: 'Lato', Arial;
    font-weight: 400;
    font-size: 1.2rem;
    color: #000;
    margin-bottom: 1.5rem;
  }

  .wp-show-posts-entry-content{
    width: 100%;
  }

  .wp-show-posts-entry-content > p{
    word-wrap: break-word;
    width: 100%;
  }

  .wp-show-posts-entry-title{
    font-size: 1.7rem;
    line-height: 2.5rem;
  }

  .wp-show-posts-entry-title > a{
    font-family: 'Lato', Arial;
    font-weight: 700;
    color: #000;
    padding-top: 2rem;
  }

  .wp-show-posts-entry-summary > p{
    margin-top: 0;
    font-size: 1.5rem;
    text-align: justify;
  }

  .impact{
    padding: 2.5rem;
  }

  .impact__title{
    text-align: center;
    font-size: 3rem;
    line-height: 4rem;
    font-family: 'Lato', Arial;
    font-weight: 400;
  }

  .impact__content > div {
    display: flex;
    flex-direction: row;
  }

  .impact_content_element{
    width: 25%;
    padding: 0rem 2rem;
  }

  .impact_content_element > div{
    text-align: center;
  }

  .impact__content__element__title{
    font-size: 5rem;
    line-height: 6rem;
    font-family: 'Lato', Arial;
    font-weight: 700;
    margin: 0;
  }

  .impact__content__element__subtitle{
    font-size: 2rem;
    line-height: 2rem;
    font-family: 'Lato', Arial;
    font-weight: 400;
  }

  .impact__footer{
    text-align: center;
    font-size: 1.5rem;
    line-height: 1.5rem;
    font-family: 'Lato', Arial;
    font-weight: 300;
    margin-top: 5rem;
  }

  .involved__title{
    text-align: center;
    font-size: 3rem;
    line-height: 4rem;
    font-family: 'Lato', Arial;
    font-weight: 400;
    margin-bottom: 8rem;
  }

  .involved__content > div{
    display: flex;
    flex-direction: row;
  }

  .involved__content .wp-show-posts{
    width: calc(100% * 1/3);
    padding: 0rem 3rem;
  }

  .involved__content .wp-show-posts-single{
    height: 100%;
  }

  .involved__content .wp-show-posts-single > div {
    display: flex;
    flex-direction: column;
    height: 100%;
  }

  .involved__content .wp-show-posts-entry-header{
    text-align: center;
    order: 2;
  }

  .involved__content .wp-show-posts-entry-title > a{
    font-size: 2rem;
    padding-top: 0;
  }

  .involved__content .wp-show-posts-image{
    border: 2px solid #000;
    order: 1;
  }

  .involved__content .wp-show-posts-entry-summary{
    text-align: justify;
    order: 3;
  }

  .involved__content .wpsp-read-more{
    text-align: center;
    margin-top: auto;
    order: 4;
  }

  .how-we{    
    background: var(--secondary-color-bg);
    padding: 5rem 0;
  }

  .how-we__title > div{
    text-align: center;
  }

  .how-we__title h2{
    text-align: center;
    font-size: 3rem;
    line-height: 4rem;
    font-family: 'Lato', Arial;
    font-weight: 400;
    margin-top: 0;
  }

  .how-we__title h4{
    margin: 0;
    font-family: 'Lato', Arial;
    font-weight: 400;
  }

  .how-we__content{
    margin-top: 4rem;
  }

  .how-we__content > div{
    display: flex;
    justify-content: space-between;
  }

  .how-we__info{
    width: 50%;
  }

  .how-we__info > div{
    width: 32rem;
  }

  .how-we__content__info > div{
    width: 32rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 60rem;
  }

  .how-we__content__info--right{
    text-align: end;
  }

  .how-we__info__single__title{
    margin: 0;
  }

  .how-we__info__single__text{
    margin-top: 0;
  }

  .how-we__figure{
    margin-top: 5rem;
    position: relative;
  }

  .how-we__figure_bg{
    margin: 0 auto;
    width: 50rem;
    height: 50rem;
    border-radius: 100%;
    border: 2px dashed #000;
  }

  .how-we__figure_img{
    width: 15rem;
  }

  .how-we__figure_img > img{
    border-radius: 100%;
  }

  .how-we__figure_img--first{
    position: absolute;
    left: 27%;
    top: -15%;
  }

  .how-we__figure_img--second{
    position: absolute;
    left: -23%;
    top: 28%;
  }

  .how-we__figure_img--third{
    position: absolute;
    right: -23%;
    bottom: 38%;
  }

  .how-we__figure_img--fourth{
    position: absolute;
    right: 28%;
    bottom: -7%;
  }

  .how-we__btn{
    margin-top: 5rem;
  }

  .how-we__btn .wp-block-button{
    display: flex;
    justify-content: center;
  }

  .how-we__btn .wp-block-button__link{
    font-size: 1.6rem;
  }

  .donate{
    background: var(--secondary-color-bg);
    margin-top: 3rem;
    padding: 5rem 0;
  }

  .donate__btn{
    text-align: center;
  }

  .donate__btn > a{
    padding: 1.5rem 10rem;
  }
  
  .donate__btn > a:hover{
    background: var(--main-color);
    color: #fff;
    border: 2px solid var(--main-color);
  }

  .newsletter{
    padding: 3rem 0;
    background: var(--secondary-color-lighter);
  }

  .newsletter__title h2{
    margin: 0;
    text-align: center;
    font-size: 3rem;
    line-height: 4rem;
    font-family: 'Lato', Arial;
    font-weight: 400;
  }

  .newsletter__title h4{
    margin: 0;
    text-align: center;
    font-size: 1.5rem;
    line-height: 2rem;
    font-family: 'Lato', Arial;
    font-weight: 400;
  }

  .newsletter__form .tnp > form{
    margin: 0 auto;
    width: 43rem;
    display: flex;
    justify-content: space-between;
  }

  .newsletter__form .tnp-email {
    width: 30rem !important;
    font-size: 1.8rem !important;
  }

  .newsletter__form .tnp-submit {
    background: var(--main-color-lighter) !important;
    width: 10rem !important;
    font-size: 1.8rem !important;
    cursor: pointer;
  }

  .newsletter__form .tnp-submit:hover {
    background: var(--main-color) !important;
  }

  @media screen and (max-width: 1350px){

    .how-we__figure {
      margin-top: 13rem;
    }

    .how-we__figure_bg{
      width: 25rem;
      height: 25rem;
    }

    .how-we__figure_img {
      width: 10rem;
    }

    .how-we__figure_img--first{
      position: absolute;
      left: 15%;
      top: -13%;
    }

    .how-we__figure_img--second{
      position: absolute;
      left: -31%;
      top: 12%;
    }

    .how-we__figure_img--third{
      position: absolute;
      right: -31%;
      bottom: 58%;
    }

    .how-we__figure_img--fourth{
      position: absolute;
      right: 15%;
      bottom: 31%;
    }

  }

  @media screen and (max-width: 1060px){

    .how-we__content > div{
      flex-direction: column;
    }

    .how-we__content__info > div{
      flex-direction: row;
      width: 100%;
    }

    .how-we__content__info{
      height: initial;
    }

    .how-we__content__info > div{
      height: initial;
    }

    .how-we__info__single{
      padding: 0 2rem;
    }

    .how-we__info__single__title{
      text-align: center;
    }

    .how-we__info__single__text{
      text-align: justify;
      margin-bottom: 0;
    }

    .how-we__figure {
      margin: 5rem 0;
    }

    .how-we__figure > div{
      position: relative;
      margin: 0 auto;
      width: 30rem;
    }

    .how-we__figure_img {
      width: 10rem;
    }

    .how-we__figure_img--first{
      position: absolute;
      left: 21%;
      top: -22%;
    }

    .how-we__figure_img--second{
      position: absolute;
      left: -19.5%;
      top: 21%;
    }

    .how-we__figure_img--third{
      position: absolute;
      right: -17%;
      bottom: 24%;
    }

    .how-we__figure_img--fourth{
      position: absolute;
      right: 20%;
      bottom: -23%;
    }

  }

  @media screen and (max-width: 755px){

    .posts > div {
      flex-direction: column;
    }

    .posts .wp-show-posts {
      width: 100%;
    }

    .posts .wp-show-posts:last-child {
      border: none;
      margin-top: 3rem;
    }

    .key > div {
      flex-direction: column;
    }

    .key__resource {
      padding-bottom: 2rem;
      width: 100%;
      max-width: initial;
    }

    .key__title {
      text-align: center;
    }

    .key__resource__li {
      text-align: center;
    }

    .key__new {
      padding-top: 2rem;
      width: 100%;
      max-width: initial;
    }

    .impact__content > div {
      flex-direction: row;
      flex-wrap: wrap;
    }

    .impact_content_element{
      width: 40%;
    }

    .how-we__content__info > div{
      flex-direction: column;
    }

    .how-we__info__single{
      margin-bottom: 3rem;
    }

    .involved__content > div{
      flex-direction: column;
    }

    .involved__content .wp-show-posts{
      margin: 0 auto;
      width: 70%;
      padding: 0rem 3rem;
      margin-bottom: 5rem;
    }

  }

  @media screen and (max-width: 505px){

    .impact__content > div {
      flex-direction: row;
    }

    .impact_content_element{
      width: 100%;
    }

    .newsletter__form .tnp > form{
      width: 30rem;
    }

    .newsletter__form .tnp-email {
      width: 22rem !important;
      font-size: 1.6rem !important;
    }

    .newsletter__form .tnp-submit {
      width: 7rem !important;
      font-size: 1.6rem !important;
    }

  }

</style>
