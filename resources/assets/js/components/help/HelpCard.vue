<template lang="html">
  <div>
    <el-card :class="{ 'help_card': true, 'hidden': hidden }">
      <div
        slot="header"
        class="clearfix">
        <span>{{ title }}</span>
        <el-button
          style="float: right; padding: 3px 0"
          type="text"
          @click="hidden = !hidden">{{ hideText }}
        </el-button>
      </div>
      <el-row :gutter="20">
        <el-col :md="12">
          <iframe
            v-if="videoLink"
            :src="videoLink"
            width="100%"
            height="200"
            frameborder="0"
            allow="autoplay; encrypted-media"/>
        </el-col>
        <el-col :md="12">
          <h4 class="help_card_list_title">{{ listTitle }}</h4>
          <ul class="help_card_list">
            <li
              v-for="(item, key) in list"
              :key="key">
              <a
                v-if="item.link"
                :href="item.link">{{ item.text }}
              </a>
              <span v-else>{{ item.text }}</span>
            </li>
          </ul>
        </el-col>
      </el-row>
    </el-card>
  </div>
</template>

<script>
export default {
  name: 'HelpCard',

  props: {
    helpId: {
      type: String,
      required: true
    },
    videoLink: {
      type: String,
      required: false,
      default: () => { return null }
    },
    title: {
      required: false,
      type: String,
      default: () => { return null }
    },
    listTitle: {
      required: false,
      type: String,
      default: () => { return null }
    },
    list: {
      required: false,
      type: Array,
      default: () => { return [] }
    }
  },

  data () {
    return {
      hidden: false
    }
  },

  computed: {
    hideText () {
      if (this.hidden) {
        return this.__('Open help')
      }
      return this.__('Hide help')
    }
  },

  watch: {
    hidden: {
      handler () {
        var helpCards = {}

        if (localStorage.getItem('helpCards')) {
          helpCards = JSON.parse(localStorage.getItem('helpCards'))
        }

        helpCards[this.helpId] = this.hidden
        localStorage.setItem('helpCards', JSON.stringify(helpCards))
      },
      deep: true
    }
  },

  mounted () {
    if (localStorage.getItem('helpCards')) {
      var helpCards = JSON.parse(localStorage.getItem('helpCards'))

      if (helpCards[this.helpId]) {
        this.hidden = helpCards[this.helpId]
      }
    }
  }
}
</script>

<style lang="css">
  .help_card.hidden .el-card__body {
      display: none;
  }
  .help_card_list_title {
      margin-top: 0px;
  }
  ul.help_card_list {
      padding-inline-start: 0px;
      list-style: none;
  }
  ul.help_card_list li {
      padding: 6px 8px;
      margin: 5px 0px;
      border: solid 1px #dadada;
      font-size: 15px;
  }
</style>
