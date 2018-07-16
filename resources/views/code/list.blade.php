<template>
  <el-row>
    <el-col>
      <el-row>
        <el-col>

          <el-card shadow="never" :body-style="{padding:0}">
            <template slot="header">
              所有{{$tableName}}列表
            </template>
            <el-table
              :border="true"
              :data="{{$basicInfo['view_name']}}List"
              size="medium"
              v-loading="loading"
              element-loading-text="玩命加载中..."
            >
              <el-table-column prop="id" label="ID"></el-table-column>
              <el-table-column prop="name" label="名称"></el-table-column>
              <el-table-column prop="created_at" label="创建日期"></el-table-column>
              <el-table-column label="操作">
                <template slot-scope="scope">
                  <el-button size="mini" type="primary" icon="el-icon-search" @click="show(scope.row)"></el-button>
                  <el-button size="mini" type="danger" icon="el-icon-delete" @click="destory(scope.row)"></el-button>
                </template>
              </el-table-column>
            </el-table>
          </el-card>
        </el-col>
      </el-row>
      <el-row type="flex" justify="center">
        <el-col :span="9">
          <el-pagination
            @current-change="setpage"
            layout="prev, pager, next"
            :current-page="page.currentPage"
            :page-size="page.pageSize"
            :total="page.total">
          </el-pagination>
        </el-col>
      </el-row>
    </el-col>
  </el-row>
</template>

<script>
  import {mapState, mapActions} from 'vuex'

  export default {
    name: "{{$basicInfo['model_name']}}",
    created() {
      this.$store.dispatch('{{$basicInfo['view_name']}}/getList');
      let vthis = this;
    },
    computed: {
      ...mapState({
          {{$basicInfo['view_name']}}List: state => state.{{$basicInfo['view_name']}}.list,
        page: state => state.{{$basicInfo['view_name']}}.page,
        loading: state => state.{{$basicInfo['view_name']}}.loading
      })
    },
    data() {
      return {}
    },
    methods: {
      ...mapActions({
        destory: '{{$basicInfo["view_name"]}}/destory'
      }),
      setpage(pageNow) {
        let page = this.page;
        page.currentPage = pageNow;

        this.$store.dispatch('{{$basicInfo["view_name"]}}/getList', page)
      },
      show(row) {
        this.$router.push({
          name: '{{$basicInfo["model_name"]}}Edit',
          params: {
            id: row.id
          }
        })
      }
    }
  }
</script>

<style scoped>

</style>
