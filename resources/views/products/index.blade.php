@extends('layouts.app')
@section('title', '商品列表')

@section('content')
<div class="row">
<div class="col-lg-10 offset-lg-1">
<div class="card">
  <div class="card-body">
<!-- 筛选组件开始 -->
<form action="{{ route('products.index') }}" class="search-form">
    <div class="row g-3">
      <div class="col-md-9">
        <div class="row g-2">
          <div class="col-auto">
            {{-- <input type="text" class="form-control form-control-sm" name="search" placeholder="搜索"> --}}
            <input type="text" class="form-control form-control-sm" name="search" placeholder="搜索" value="{{ request('search') }}">
          </div>
          <div class="col-auto">
            <button class="btn btn-primary btn-sm">搜索</button>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <select name="order" class="form-control form-control-sm float-md-end">
            <option value="">排序方式</option>
            <option value="price_asc" @if(request('order') == 'price_asc') selected @endif>价格从低到高</option>
            <option value="price_desc" @if(request('order') == 'price_desc') selected @endif>价格从高到低</option>
            <option value="sold_count_desc" @if(request('order') == 'sold_count_desc') selected @endif>销量从高到低</option>
            <option value="sold_count_asc" @if(request('order') == 'sold_count_asc') selected @endif>销量从低到高</option>
            <option value="rating_desc" @if(request('order') == 'rating_desc') selected @endif>评价从高到低</option>
            <option value="rating_asc" @if(request('order') == 'rating_asc') selected @endif>评价从低到高</option>
          </select>

      </div>
    </div>
  </form>
  <!-- 筛选组件结束 -->

    <div class="row products-list">
      @foreach($products as $product)
        <div class="col-3 product-item">
          <div class="product-content">
            <div class="top">
                <div class="img"><img src="{{ $product->image_url }}" alt=""></div>
              <div class="price"><b>￥</b>{{ $product->price }}</div>
              <div class="title">{{ $product->title }}</div>
            </div>
            <div class="bottom">
              <div class="sold_count">销量 <span>{{ $product->sold_count }}笔</span></div>
              <div class="review_count">评价 <span>{{ $product->review_count }}</span></div>
            </div>
          </div>
        </div>
          {{-- <button id="myButton">Click me</button> --}}
      @endforeach
    </div>
    {{-- <div class="float-end">{{ $products->render() }} 老写法 --}}
    <div class="float-end">{!! $products->appends($filters)->render() !!}  </div>
    {{-- <div class="float-right">{{ $products->appends($filters)->render() }}</div> --}}
  </div>
</div>
</div>
</div>
@endsection
{{-- document: 这是一个指向整个 HTML 文档的引用。
addEventListener: 这是一个方法，用于在指定元素上注册事件监听器。
DOMContentLoaded: 这是监听器要监听的事件类型。DOMContentLoaded 事件在 HTML 文档被完全加载和解析完毕后触发，不需要等待样式表、图像和子框架完成加载。 --}}
@section('scriptsAfterJs')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 获取下拉框元素
        var orderSelect = document.querySelector('select[name="order"]');

        // 添加事件监听器
        orderSelect.addEventListener('change', function() {
            // 触发表单提交
            this.form.submit();
        });
    });
</script>
@endsection
