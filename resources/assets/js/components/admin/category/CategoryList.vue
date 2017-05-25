<template>
  <div class="main-container">
    <el-table :data="categories" border style="width: 100%">
      <el-table-column fixed label="id" width="180" prop="id"></el-table-column>
      <el-table-column label="名称" width="180" prop="name"></el-table-column>
      <el-table-column label="创建时间" width="180" prop="createdAt"></el-table-column>
      <el-table-column label="更新时间" width="180" prop="updatedAt"></el-table-column>
      <el-table-column label="操作" width="250">
        <template scope="scope">
          <el-button
            size="small"
            type="success"
            @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
          <el-button
            size="small"
            type="danger"
            @click="handleDelete(scope.$index, scope.row)">删除</el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        categories: []
      }
    },

    mounted() {
      let that = this
      axios.get('/api/category')
        .then(function (response) {
          response.data.forEach(function (category) {
            that.categories.push({
              id: category.id,
              name: category.name,
              createdAt: category.created_at,
              updatedAt: category.updated_at
            })
          })
        })
        .catch (function (error) {
          that.$notify.error({
            title: '失败',
            message: error.response.data.error
          })
        })
    },

    methods: {
      handleDelete: function (index, row) {
        let that = this
        axios.delete('/api/category/' + row.id)
          .then(function () {
            that.categories.splice(index, 1)
          })
          .catch (function (error) {
            that.$notify.error({
              title: '失败',
              message: error.response.data.error
            })
          })
      }
    }
  }
</script>