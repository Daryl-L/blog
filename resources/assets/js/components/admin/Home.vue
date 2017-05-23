<template>
  <div class="home">
    <el-col :span="5" class='navbar'>
      <el-row class="topbar"></el-row>
      <el-menu default-active="2" @open="handleOpen" @close="handleClose" :router="true">
        <el-submenu index="1">
          <template slot="title"><i class="el-icon-document"></i>文章</template>
          <el-menu-item-group>
            <el-menu-item index="1-1" :route="{ name: 'newArticle' }"><i class="el-icon-edit"></i>写文章</el-menu-item>
            <el-menu-item index="1-2" :route="{ name: 'articleList' }"><i class="el-icon-menu"></i>文章列表</el-menu-item>
          </el-menu-item-group>
        </el-submenu>
        <el-submenu index="2">
          <template slot="title"><i class="el-icon-message"></i>栏目</template>
          <el-menu-item-group>
            <el-menu-item index="2-1" :route="{ name: 'newCategory' }"><i class="el-icon-edit"></i>新建栏目</el-menu-item>
            <el-menu-item index="2s-2"><i class="el-icon-document"></i>栏目列表</el-menu-item>
          </el-menu-item-group>
        </el-submenu>
      </el-menu>
    </el-col>
    <el-col :span="19" class="child">
      <el-row class="topbar"></el-row>
      <router-view></router-view>
    </el-col>
  </div>
</template>

<script>
  export default {
    methods: {
      handleOpen(key, keyPath) {
        console.log(key, keyPath);
      },
      handleClose(key, keyPath) {
        console.log(key, keyPath);
      }
    }
  }
</script>

<style scoped>
  .home,.tac {
    height: 100%;
    overflow: hidden;
  }

  .navbar {
    background: #eef1f6;
    height: 100%;
    border: none;
  }

  .topbar {
    background: #20a0ff;
    height: 50px;
  }

  .child {
    height: 100%;
  }

  .main-container {
    height: 100%;
    width: 100%;
    padding: 20px;
  }
</style>