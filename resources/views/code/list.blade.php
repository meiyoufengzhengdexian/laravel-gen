<template>
    <el-container>
    <el-card shadow="never" style="width: 100%;" :body-style="{padding:0,border:0}" >
        <template slot="header">
            所有{{$tableName}}列表
        </template>
        <el-table
            style="border-top:0;border-bottom: 0;"
            :border="true"
            :data="{{$basicInfo['view_name']}}List"
            size="medium"
            v-loading="loading"
            element-loading-text="玩命加载中..."
        >
            @foreach($fields as $field)
                @if($field['index'])
                    @if($field['is_ref'] && $field['ref_type'] == 'belongsTo')
                        <el-table-column prop="{{$field['ref_method']}}.name"
                                         label="{{$field['label']}}"></el-table-column>
                    @else
                        <el-table-column prop="{{$field['name']}}"
                                         label="{{$field['label']}}"></el-table-column>
                    @endif

                @endif
            @endforeach
            <el-table-column label="操作">
                <template slot-scope="scope">
                    <el-button size="mini" type="primary" icon="el-icon-search"
                               @click="show(scope.row)"></el-button>
                    <el-button size="mini" type="danger" icon="el-icon-delete"
                               @click="destory(scope.row)"></el-button>
                </template>
            </el-table-column>
        </el-table>

        <el-pagination
            style="float: right"
            @current-change="setpage"
            layout="prev, pager, next"
            :current-page="page.currentPage"
            :page-size="page.pageSize"
            :total="page.total">
        </el-pagination>
    </el-card>
    </el-container>
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
