import http from '@/lib/admin/http'
import {Message, MessageBox} from 'element-ui'

export default {
  namespaced: true,
  state: {
    url: '/admin/{{ lcfirst($basicInfo['model_name']) }}',
    createUrl: '/admin/{{ lcfirst($basicInfo['model_name']) }}',
    list: [],
    new{{ $basicInfo['model_name'] }}: {},
    {{$basicInfo['model_name']}}: {},
    loading: false,
    page: {
      total: 0,
      pageSize: 8,
      currentPage: 1,
    },
    search: {
      page: 1
    },
    ruleForm:{},
    rules: {
        {{-- element-ui 的rule和larvel的验证规则需要转换 --}}
    }
  },
  mutations: {
        setSearch(state, search){
        state.search = search;
    },
    setList(state, data) {
      state.list = data;
      state.loading = false;
    },
    setPage(state, page) {
      state.page = page;
      state.search.page = state.page.currentPage;
    },
    loading(state) {
      state.loading = true;
    },
    closeLoading(state) {
      state.loading = false;
    },
    resetCreate(state) {
      state.new{{ $basicInfo['model_name'] }} = {};
    },
    set{{$basicInfo['model_name']}}(state, {{ $basicInfo['model_name'] }}) {
      state.{{ $basicInfo['model_name'] }} = {{ $basicInfo['model_name'] }};
    },
    reset{{$basicInfo['model_name']}}(state) {
      state.{{ $basicInfo['model_name'] }} = {}
    }
  },
  actions: {
    /**
     * 获取列表
     * @param context
     * @param page
     */
    getList(context, page) {
      //传入分页
      return new Promise((succes, faild) => {

        context.commit('loading');
        if (page) {
          context.commit('setPage', page);
        }
        //遮罩
        context.commit('loading');

        //获取数据
        http.getData(context.state.url, context.state.search).then(res => {
          //赋值
          context.commit('setList', res.data.list.data);

          let page = {
            'pageSize': res.data.list.per_page,
            'total': res.data.list.total,
            'currentPage': res.data.list.current_page,
          };

          //分页赋值
          context.commit('setPage', page);

          succes();
        }).catch(faild)
      });


    },

    create(context, {{ lcfirst($basicInfo['model_name']) }}) {
      return new Promise((success, faild) => {
        http.postData(context.state.createUrl, {{ lcfirst($basicInfo['model_name']) }}).then(res => {
          context.commit('resetCreate');
          success(res);
        }).catch(faild)
      })

    },
    /**
     * 获取详情
     * @param context
     * @param {{ lcfirst($basicInfo['model_name']) }}
     * @returns {Promise<any>}
     */
    show(context, {{ lcfirst($basicInfo['model_name']) }}) {
      return new Promise((success, faild) => {
        context.commit('loading');
        context.commit('reset{{ $basicInfo['model_name'] }}');

        http.getData(context.state.url + '/' + {{ lcfirst($basicInfo['model_name']) }}.id, {{ lcfirst($basicInfo['model_name']) }})
          .then(res => {
            context.commit('closeLoading');
            console.log(context.state.loading);
            context.commit('set{{ $basicInfo['model_name'] }}', res.data.data);
            success(res.data)
          })
          .catch(res => {
            context.commit('closeLoading');
            faild()
          });
      })
    },

    /**
     * 更新
     * @param context
     * @param {{$basicInfo['model_name']}}
     * @returns {Promise<any>}
     */
    update(context) {
      return new Promise((success, faild) => {
        http.putData(context.state.url + '/' + context.state.{{ $basicInfo['model_name'] }}.id, context.state.{{$basicInfo['model_name']}})
          .then(res => {
            success(res.data)
          }).catch(faild)
        ;
      })
    },
    destory(context, {{ $basicInfo['model_name'] }}) {
      MessageBox.confirm('确定要删除此数据？')
        .then(_ => {
          context.commit('loading');
          http.deleteData(context.state.url + '/' + {{ $basicInfo['model_name'] }}.id).then(res => {
            context.dispatch('getList');
          })
        })
        .catch(_ => {
          Message.error('未进行操作');
        });
    }
  },
  getters: {}
}
