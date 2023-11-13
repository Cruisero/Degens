@extends('layouts.app')
@section('title', ($address->id ? '修改': '新增') . '收货地址')

@section('content')
  <div class="row">
    <div class="col-md-10 offset-lg-1">
      <div class="card">
        <div class="card-header">
          <h2 class="text-center">
            {{ $address->id ? '修改': '新增' }}收货地址
          </h2>
        </div>
        <div class="card-body">

        <!-- 输出后端报错开始 -->
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <h4>有错误发生：</h4>
            <ul>
            @foreach ($errors->all() as $error)
                <li><i class="glyphicon glyphicon-remove"></i> {{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif
            <form class="form-horizontal" role="form" action="{{ route('user_addresses.store') }}" method="post">
            <div id="app">

                {{ csrf_field() }}
              <user-addresses-create-and-edit :initial-address="{{ json_encode([old('province', $address->province), old('cityId', $address->city), old('districtId', $address->district)]) }}">

             </user-addresses-create-and-edit>

                <!-- 插入了 3 个隐藏的字段 -->
                <!-- 通过 v-model 与 user-addresses-create-and-edit 组件里的值关联起来 -->
                <!-- 当组件中的值变化时，这里的值也会跟着变 -->


                <div class="form-group row mt-3">
                    <label class="col-form-label text-md-right col-sm-2">详细地址</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" name="address" value="{{ old('address', $address->address) }}">
                    </div>
                </div>
                <div class="form-group row mt-3">
                    <label class="col-form-label text-md-right col-sm-2">邮编</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="zip" value="{{ old('zip', $address->zip) }}">
                    </div>
                  </div>
                <div class="form-group row mt-3">
                    <label class="col-form-label text-md-right col-sm-2">姓名</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="contact_name" value="{{ old('contact_name', $address->contact_name) }}">
                    </div>
                </div>
                <div class="form-group row mt-3">
                    <label class="col-form-label text-md-right col-sm-2">电话</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="contact_phone" value="{{ old('contact_phone', $address->contact_phone) }}">
                    </div>
                </div>
                <div class="form-group row text-center mt-3">
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="https://unpkg.com/vue@next"></script>
<script src="{{ asset('js/app.js') }}"></script>
{{-- <script type="module">
  import { createApp } from "vue";
  import SelectDistrict from "./components/SelectDistrict.vue";
  import UserAddressesCreateAndEdit from "./components/UserAddressesCreateAndEdit.vue";

  const app = createApp(UserAddressesCreateAndEdit);
  app.component("select-district", SelectDistrict);
//   app.component("user-addresses-create-and-edit", UserAddressesCreateAndEdit);


  app.mount("#app");
</script> --}}
@endsection
