<template>
  <el-card header="新建">
    <el-form :model="{{$basicInfo['view_name']}}"
             :rules="rules"
             ref="ruleForm"
             label-position="right"
             label-width="80px"
    >

        @foreach($fields as $field)
            @if($field['create'])
            @php($type=$field['show_type'])
            {!!  \App\Lib\Code::$type($field['label'], $basicInfo['view_name'], $field['name'])  !!}
            @endif
        @endforeach

      <el-form-item>
        <el-button type="primary" @click="{{$basicInfo['view_name']}}Create({{$basicInfo['view_name']}})">创建</el-button>
        <el-button type="success" @click="backPage">返回</el-button>
      </el-form-item>
    </el-form>
  </el-card>
</template>

<script>
  import {mapState} from 'vuex'
  import back from '@/mixin/back'

  export default {
    name: "{{$basicInfo['model_name']}}Create",
    mixins: [back],
    computed: {
      ...mapState({
        {{$basicInfo["view_name"]}}: state => state.{{$basicInfo["view_name"]}}.new{{ $basicInfo['model_name'] }},
        rules: state => state.{{$basicInfo["view_name"]}}.rules,
        loading: state => state.{{$basicInfo["view_name"]}}.loading,
      }),
    },
    methods: {
        {{$basicInfo["view_name"]}}Create({{$basicInfo["view_name"]}}) {
        let vthis = this;
        this.$refs['ruleForm'].validate(validate => {
          if (!validate) {
            return;
          }
          this.$store.dispatch('{{$basicInfo["view_name"]}}/create', {{$basicInfo["view_name"]}}).then((res) => {
            vthis.$confirm('是否关闭此页面').then(_ => {
              vthis.$router.go(-1);
            }).catch(_ => {
            });
          })
        });
      }
    }
  }
</script>

<style scoped>

</style>
