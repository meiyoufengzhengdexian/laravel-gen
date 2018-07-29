<template>
  <el-select v-model="{{ $field['ref_method'] }}_id" filterable @change="changeHandle">
    <el-option :value="0" label="全部"></el-option>
    <el-option
      v-for="({{ $field['ref_method'] }}, {{ $field['ref_method'] }}Key) in {{ $field['ref_method'] }}List"
      :label="{{ $field['ref_method'] }}.name"
      :value="{{ $field['ref_method'] }}.id"
      :key="{{ $field['ref_method'] }}Key"
    ></el-option>
  </el-select>
</template>

<script>
  import http from '@/lib/admin/http'

  export default {
    name: "{{ camel_case($field['ref_method']) }}Option",
    props:{
        placeholder:{
            default:'请选择'
        },
        value:{
            require:true
        }
    },
    data() {
      return {
        {{$field['ref_method']}}List:[],
          {{$field['name']}}: 0
      }
    },
      watch: {
          value(value) {
              this.{{ $field['ref_method'] }}_id = value
          },
          {{ $field['ref_method'] }}_id(value) {
              this.$emit('input', value)
          }
      },
    methods: {
      get{{camel_case($field['ref_method'])}}List (){
        let vthis = this;
        http.getData(this.$store.state.{{$field['ref_method']}}.url, {all:true})
          .then(res =>{
            vthis.{{$field['ref_method']}}List = res.data.list
          })
      },
      changeHandle (){
        this.$emit('input', this.{{ $field['name'] }})
      }
    },
    created() {
      this.{{ $field['name'] }} = this.value;
      this.get{{camel_case($field['ref_method'])}}List()
    }
  }
</script>

<style scoped>

</style>
