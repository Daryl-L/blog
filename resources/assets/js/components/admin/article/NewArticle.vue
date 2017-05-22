<template>
  <div class="main-container"> 
    <el-row>
      <el-input v-model="title" placeholder="请输入标题"></el-input>
    </el-row>
    <el-row>
      <el-col :span="18">
        <el-input v-model="sign" placeholder="请输入标识（用于 url 展示）"></el-input>
      </el-col>
      <el-col :offset="1" :span="5">
        <el-select v-model="category" filterable placeholder="请选择栏目">
          <el-option
            v-for="option in options"
            :key="option.value"
            :label="option.label"
            :value="option.value">
          </el-option>
        </el-select>
      </el-col>
    </el-row>
    <div id="editor">
      <textarea v-model="content" @input="update"></textarea>
      <div v-html="compiledMarkdown" class="preview"></div>
    </div>
      <el-button type="primary" :loading="loading" @click="publish">提交</el-button>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        title: '',
        sign: '',
        category: '',
        content: '',
        options: [],
        loading: false
      }
    },

    mounted() {
      let that = this
      axios.get('/api/category')
        .then(function (response) {
          response.data.forEach(function (item) {
            that.options.push({
              value: item.id,
              label: item.name
            })
          })
        })
        .catch(function (error) {
          console.log(error)
        })
    },

    computed: {
      compiledMarkdown: function () {
        var marked = require("marked")
        return marked(this.content, { sanitize: true })
      }
    },
    methods: {
      update: _.debounce(function (e) {
        this.content = e.target.value
      }, 300),

      publish: function () {
        this.loading = true;
        let that = this
        axios.post('/api/article', {
          'title': that.title,
          'sign' : that.sign,
          'category': that.category,
          'content': that.content
        })
        .then(function (response) {
          console.log(response)
          that.loading = false
        })
        .catch(function (error) {
          console.log(error)
          that.loading = false
        })
      }
    }
  }
</script>

<style scoped>
  .el-row {
    margin-top: 10px;
  }

  #editor {
    height: 70%;
    width: 100%;
    margin-top: 10px;
    margin-left: auto;
    margin-right: auto;
    border: #ccc solid 1px;
    border-radius: 5px;
  }

  textarea,.preview {
    display: inline-block;
    width: 49%;
    height: 100%;
    vertical-align: top;
    box-sizing: border-box;
    padding: 0 20px;
    border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
  }

  textarea {
    border: none;
    border-right: 1px solid #ccc;
    resize: none;
    outline: none;
    background-color: #f6f6f6;
    font-size: 14px;
    font-family: 'Monaco', courier, monospace;
    padding: 20px;
  }

  .el-button {
    margin-top: 10px;
    float: right;
  }

  .el-select {
    display: block;
  }

  code {
    color: #f66;
  }
</style>