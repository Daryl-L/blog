<template>
  <div class="main-container">
    <el-table :data="articles" border style="width: 100%">
      <el-table-column fixed label="标题" width="180" prop="title"></el-table-column>
      <el-table-column label="标识" width="180" prop="sign"></el-table-column>
      <el-table-column label="栏目" width="180" prop="category"></el-table-column>
      <el-table-column label="发布" width="180">
        <template scope="scope">
          <span>{{ scope.row.publish ? '已发布' : '未发布' }}</span>
        </template>
      </el-table-column>
      <el-table-column label="评论条数" width="100" align="center" prop="commentsCount"></el-table-column>
      <el-table-column label="创建时间" width="180" prop="createdAt"></el-table-column>
      <el-table-column label="更新时间" width="180" prop="updatedAt"></el-table-column>
      <el-table-column label="操作" width="250">
        <template scope="scope">
          <el-button
            size="small"
            type="success"
            @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
          <el-button
            v-if="!scope.row.publish"
            size="small"
            type="warning"
            @click="handlePublish(scope.$index, scope.row)">发布</el-button>
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
        articles: []
      }
    },

    mounted() {
      let that = this
      axios.get('/api/article')
        .then(function (response) {
          console.log(response.data)
          response.data.forEach(function (article) {
            that.articles.push({
              id: article.id,
              title: article.title,
              sign: article.sign,
              category: article.category.name,
              publish: article.published,
              commentsCount: article.comments_count,
              createdAt: article.created_at,
              updatedAt: article.updated_at
            })
          })
        })
        .catch(function (error) {
          console.log(error)
        })
    },

    methods: {
      handleEdit: function (index, row) {
        console.log(index, row)
      },

      handlePublish: function (index, row) {
        let that = this
        axios.patch('/api/article/' + row.id)
          .then(function (response) {
            that.articles[index].published ^= 1
            console.log(that)
          })
          .catch(function (error) {
            console.log(error)
          })
      },

      handleDelete: function (index, row) {
        let that = this
        axios.delete('/api/article/' + row.id)
          .then(function (response) {
            that.articles.pop(index)
          })
          .catch(function (error) {
            console.log(error)
          })
      }
    }
  }
</script>