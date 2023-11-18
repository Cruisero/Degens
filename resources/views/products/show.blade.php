@extends('layouts.app')
@section('title', $product->title)

@section('content')
<div class="row">
<div class="col-lg-10 offset-lg-1">
<div class="card">
  <div class="card-body product-info">
    <div class="row">
      <div class="col-5">
        <img class="cover" src="{{ $product->image_url }}" alt="">
      </div>
      <div class="col-7">
        <div class="title">{{ $product->title }}</div>
        <div class="price"><label>价格</label><em>￥</em><span>{{ $product->price }}</span></div>
        <div class="sales_and_reviews">
          <div class="sold_count">累计销量 <span class="count">{{ $product->sold_count }}</span></div>
          <div class="review_count">累计评价 <span class="count">{{ $product->review_count }}</span></div>
          <div class="rating" title="评分 {{ $product->rating }}">评分 <span class="count">{{ str_repeat('★', floor($product->rating)) }}{{ str_repeat('☆', 5 - floor($product->rating)) }}</span></div>
        </div>
        <div class="skus">
          <label>选择</label>
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            @foreach($product->skus as $sku)
            <label
                class="btn sku-btn"
                data-price="{{ $sku->price }}"
                data-stock="{{ $sku->stock }}"
                data-toggle="tooltip"
                title="{{ $sku->description }}"
                data-placement="bottom">
              <input type="radio" name="skus" autocomplete="off" value="{{ $sku->id }}"> {{ $sku->title }}
            </label>
          @endforeach
          </div>
        </div>
        <div class="cart_amount"><label>数量</label><input type="text" class="form-control form-control-sm" value="1"><span>件</span><span class="stock"></span></div>
        <div class="buttons">
            @if($favored)
              <button class="btn btn-danger btn-disfavor">取消收藏</button>
            @else
              <button class="btn btn-success btn-favor">❤ 收藏</button>
            @endif
            <button class="btn btn-primary btn-add-to-cart m-lg-2">加入购物车</button>
          </div>
      </div>
    </div>
    <div class="product-detail">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" href="#product-detail-tab" aria-controls="product-detail-tab" role="tab" data-toggle="tab" aria-selected="true">商品详情</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#product-reviews-tab" aria-controls="product-reviews-tab" role="tab" data-toggle="tab" aria-selected="false">用户评价</a>
        </li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="product-detail-tab">
          {!! $product->description !!}
        </div>
        <div role="tabpanel" class="tab-pane" id="product-reviews-tab">
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@section('scriptsAfterJs')
<script>


    document.addEventListener('DOMContentLoaded', () => {

        // 绑定 Tooltip
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))// 查询所有设置了 data-toggle="tooltip" 属性的 DOM 元素。
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                trigger: 'hover' //设置触发方式：Tooltip 是设置为在鼠标悬停（hover）时触发。
            })
        });

        // 绑定 SKU 按钮点击事件
        document.querySelectorAll('.sku-btn').forEach(button => {
            button.addEventListener('click', () => {
                const price = button.getAttribute('data-price');
                const stock = button.getAttribute('data-stock');

                document.querySelector('.product-info .price span').textContent = price;
                document.querySelector('.product-info .stock').textContent = `库存：${stock}件`;
            });
        });


         // 找到收藏按钮并绑定点击事件
        const favorButton = document.querySelector('.btn-favor');
        if(favorButton){
            favorButton.addEventListener('click', () => {
            axios.post('{{ route('products.favor', ['product' => $product->id]) }}')
        .then(function () { // 请求成功会执行这个回调
            Swal.fire({
            title: "Good job!",
            icon: "success"
            }).then(function () {
            // 当 Swal 弹窗关闭时，刷新页面
            location.reload();
        });
        }, function(error) { // 请求失败会执行这个回调
          // 如果返回码是 401 代表没登录
          if (error.response && error.response.status === 401) {
            Swal.fire({
            title: "请先登录!",
            icon: "error"
            });
          } else if (error.response && (error.response.data.msg || error.response.data.message)) {
            // 其他有 msg 或者 message 字段的情况，将 msg 提示给用户
            Swal.fire({
            title: errorData.msg ? errorData.msg : errorData.message,
            icon: 'error',
            });
          }  else {
            // 其他情况应该是系统挂了
            Swal.fire({
            title: "系统错误!",
            icon: "error"
            });
          }
        });



        });
        }


        const disfavorButton = document.querySelector('.btn-disfavor');
        if (disfavorButton) {
            disfavorButton.addEventListener('click', () => {
                axios.delete('{{ route('products.disfavor', ['product' => $product->id]) }}') // 使用正确的取消收藏路由
                .then(function () {
                    Swal.fire({
                        title: "取消收藏成功",
                        icon: "success"
                    }).then(function () {
                        location.reload();
                    });
                })
            });
        }



})


</script>
@endsection

