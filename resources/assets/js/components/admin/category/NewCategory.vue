<template>
  <div class="main-container">
    <el-form :inline="true" :label-position="labelPosition" label-width="80px" :model="category">
      <el-form-item label="名称">
        <el-input v-model="category.name"></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" :loading="loading" @click="onSubmit">添加</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        labelPosition: 'right',
        loading: false,
        category: {
          name: ''
        }
      }
    },

    methods: {
      onSubmit: function () {
        let that = this
        this.loading = true
        if (this.category.name != '') {
          axios.post('/api/category', {
            name: this.category.name
          })
          .then(function (response) {
            that.$notify({
              title: '成功',
              message: response.data.msg,
              type: 'success'
            })
            that.loading = false
          })
          .catch(function (error) {
            that.$notify.error({
              title: '失败',
              message: error.response.data.error
            })
            that.loading = false
          })
        } else {
          this.$notify.error({
            title: '失败',
            message: '名称不能为空'
          })
          this.loading = false
        }
      }
    }
  }
</script>