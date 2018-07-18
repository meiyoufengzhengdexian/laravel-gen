<template>
    <el-card v-loading="loading">
        <template slot="header">
            编辑{{$basicInfo['view_name']}}
        </template>
        <el-form :model="{{$basicInfo['view_name']}}"
                 :rules="rules"
                 ref="ruleForm"
                 label-position="right"
                 label-width="80px">

            @foreach($fields as $field)
                @if($field['create'])
                    @php($type=$field['show_type'])
                    {!!  \App\Lib\Code::$type($field['label'], $basicInfo['model_name'], $field['name'])  !!}
                @endif
            @endforeach

            <el-form-item>
                <el-button type="primary" @click="update('ruleForm')">保存</el-button>
                <el-button type="success" @click="back">返回</el-button>
            </el-form-item>
        </el-form>
    </el-card>
</template>

<script>
    import {mapState} from 'vuex'
    import '@/static/test'

    export default {
        name: "{{$basicInfo['model_name']}}Edit",
        props: {
            id: {
                'required': true
            }
        },
        data() {
            return {
            {{$basicInfo['view_name']}}:{}
            }
        },
        computed: {
            ...mapState({
                {{$basicInfo['model_name']}}: state => state.{{$basicInfo['view_name']}}.{{$basicInfo['model_name']}},
                rules: state => state.{{$basicInfo['view_name']}}.rules,
                loading: state => state.{{$basicInfo['view_name']}}.loading
            })
        },
        methods: {
            back() {
                this.$router.back();
            },
            update(form) {
                let vthis = this;

                this.$refs[form].validate((validate) => {
                    if (!validate) {
                        return;
                    }
                    this.$store.dispatch('{{$basicInfo["view_name"]}}/update').then(res => {
                        vthis.$confirm('是否关闭页面?')
                            .then(_ => {
                                vthis.$router.back();
                            });
                    })
                        .catch(res =>{
                            console.log(res);
                        });
                });

            }
        },
        created() {
            this.$store.dispatch('{{$basicInfo["view_name"]}}/show', {id: this.id});
        }
    }
</script>

<style scoped>

</style>
