<template>
  <el-form :inline="true">

      @foreach($fields as $field)
          @if($field['search'])
              @if($field['is_ref'] && $field['ref_type'] == 'belongsTo')
                  <el-form-item label="{{$field['label']}}" prop="{{ $field['name'] }}">
                      <{{kebab_case($field['ref_class'].'Option')}} v-model="searchForm.{{ $field['name'] }}"></{{kebab_case($field['ref_class']. 'Option')}}>
                  </el-form-item>
              @elseif($field['show_type'] == 'datetime')
                  <el-date-picker
                      v-model="searchForm.{{ camel_case('start_'.$field['name']) }}"
                      type="date"
                      value-format="yyyy-MM-dd"
                      placeholder="起始created_at时间">
                  </el-date-picker>
                  <el-date-picker
                      v-model="searchForm.{{ camel_case('end_'.$field['name']) }}"
                      type="date"
                      value-format="yyyy-MM-dd"
                      placeholder="截止created_at时间">
                  </el-date-picker>
              @else
                  @php($type=$field['show_type'])
                  {!!  \App\Lib\Code::$type($field['label'], 'searchForm', $field['name'])  !!}
              @endif
          @endif
      @endforeach
      <el-form-item>
          <el-button type="primary" icon="el-icon-search" @click="search">搜索</el-button>
      </el-form-item>
  </el-form>
</template>

<script>
    @foreach($fields as $field)
        @if($field['is_ref'] && $field['ref_type'] == 'belongsTo')
    import {{ ucfirst(camel_case($field['ref_method'].'Option')) }} from "../{{camel_case($field['ref_class'])}}/{{ ucfirst(camel_case($field['ref_method'].'Option')) }}";
    @endif
    @endforeach
  export default {
    name: "{{ucfirst($basicInfo['model_name'])}}Search",
      components: {
          @foreach($fields as $field)
          @if($field['is_ref'] && $field['ref_type'] == 'belongsTo')
          {{ ucfirst(camel_case($field['ref_class'].'Option')) }}
          @endif
          @endforeach
      },
    data() {
      return {
        searchForm: {
        },
      }
    },
    methods:{
      search () {
        this.$store.commit('{{$basicInfo["view_name"]}}/setSearch', this.searchForm);
        this.$store.dispatch('{{$basicInfo["view_name"]}}/getList')
      }
    }
  }
</script>

<style scoped>

</style>
