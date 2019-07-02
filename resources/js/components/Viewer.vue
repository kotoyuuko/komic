<template>
  <section class="viewer">
    <div class="image">
      <img :src="link" />

      <div class="control">
        <div class="prev" @click="prev"></div>
        <div class="menu" @click="menu"></div>
        <div class="next" @click="next"></div>
      </div>

      <div class="pager" :hidden="toolbarHidden">
        <span>{{ current + 1 }} / {{ total }}</span>
      </div>

      <div class="toolbar" :hidden="toolbarHidden">
        <div class="toolitem" :hidden="toolbarHidden">
          <a href="/">comics</a>
        </div>
        <div class="toolitem" :hidden="toolbarHidden">
          <a @click="del">delete</a>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Viewer',
  props: {
    token: String,
    name: String
  },
  computed: {
    total () {
      return this.links.length
    },
    link () {
      return this.links[this.current]
    },
    deleteUrl () {
      return '/comic/' + this.name + '/delete'
    }
  },
  methods: {
    getData () {
      axios.get('/api/comic/' + this.name + '.json', {
        headers: {
          'Authorization': 'Bearer ' + this.token
        }
      }).then(res => {
        this.links = res.data
      }).catch(err => {
        console.log(err)
      })
    },
    prev () {
      if (this.current > 0) {
        this.current -= 1
      }
    },
    menu () {
      this.toolbarHidden = !this.toolbarHidden
    },
    next () {
      if (this.current < this.total - 1) {
        this.current += 1
      }
    },
    del () {
      if (confirm('confirm?')) {
        location.href = this.deleteUrl
      }
    }
  },
  data () {
    return {
      links: [],
      current: 0,
      toolbarHidden: true
    }
  },
  mounted () {
    this.getData()
  }
}
</script>

<style lang="scss">
section.viewer {
  width: 100%;
  height: 100%;
  top: 0;
  bottom: 0;
  position: absolute;
  overflow: hidden;
}

div.image {
  width: 100%;
  height: 100%;
  position: relative;

  img {
    max-width: 100%;
    max-height: 100%;
    min-width: auto;
    min-height: auto;
    height: auto;
    width: auto;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    z-index: -1;
  }

  div.control {
    z-index: 0;
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    display: flex;

    div.prev {
      width: 30%;
    }

    div.menu {
      width: 40%;
    }

    div.next {
      width: 30%;
    }
  }

  div.pager {
    z-index: 1;
    width: 100%;
    height: 70px;
    position: absolute;
    top: 0;
    background-color: #fcfaf2;
    text-align: center;

    span {
      display: block;
      margin-top: 20px;
      font-size: 20px;
    }
  }

  div.toolbar {
    z-index: 1;
    width: 100%;
    height: 70px;
    position: absolute;
    bottom: 0;
    background-color: #fcfaf2;

    div.toolitem {
      display: inline-block;
      text-align: center;
      width: 49%;
      height: 100%;

      a {
        display: block;
        height: 100%;
        width: 100%;
        text-decoration: none;
        color: #434343;
        font-size: 20px;
        padding-top: 20px;
      }
    }
  }
}
</style>

