@extends('layouts.app')
@section('title', '购物车')

@section('content')
<div class="row">
<div class="col-lg-10 offset-lg-1">
<div class="card">
  <div class="card-header">我的购物车</div>
  <div class="card-body">
    <table class="table table-striped">
      <thead>
      <tr>
        <th><input type="checkbox" id="select-all"></th>
        <th>商品信息</th>
        <th>单价</th>
        <th>数量</th>
        <th>操作</th>
      </tr>
      </thead>
      <tbody class="product_list">
      @foreach($cartItems as $item)
        <tr data-id="{{ $item->productSku->id }}">
          <td>
            <input type="checkbox" name="select" value="{{ $item->productSku->id }}" {{ $item->productSku->product->on_sale ? 'checked' : 'disabled' }}>
          </td>
          <td class="product_info">
            <div class="preview">
              <a target="_blank" href="{{ route('products.show', [$item->productSku->product_id]) }}">
                <img src="{{ $item->productSku->product->image_url }}">
              </a>
            </div>
            <div @if(!$item->productSku->product->on_sale) class="not_on_sale" @endif>
              <span class="product_title">
                <a target="_blank" href="{{ route('products.show', [$item->productSku->product_id]) }}">{{ $item->productSku->product->title }}</a>
              </span>
              <span class="sku_title">{{ $item->productSku->title }}</span>
              @if(!$item->productSku->product->on_sale)
                <span class="warning">该商品已下架</span>
              @endif
            </div>
          </td>
          <td><span class="price">￥{{ $item->productSku->price }}</span></td>
          <td>
            <input type="text" class="form-control form-control-sm amount" @if(!$item->productSku->product->on_sale) disabled @endif name="amount" value="{{ $item->amount }}">
          </td>
          <td>
            <button class="btn btn-sm btn-danger btn-remove">移除</button>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
@endsection
@section('scriptsAfterJs')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // 获取所有 class 包含 'btn-remove' 的元素
    document.querySelectorAll('.btn-remove').forEach(function (button) {
      // 为每个按钮添加点击事件监听器
      button.addEventListener('click', function () {
        // 使用 closest 方法找到最近的 tr 祖先元素
        const id = this.closest('tr').getAttribute('data-id');
        Swal.fire({
            title: '确认要将该商品移除?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        })
        .then(function(willDelete) {
          if (!willDelete) {
            return;
          }
          axios.delete('/cart/' + id)
            .then(function () {
              location.reload();
            })
        });
      });
    });
  });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
      // 监听 全选/取消全选 单选框的变更事件
      document.getElementById('select-all').addEventListener('change', function() {
        // 获取单选框的选中状态
        const checked = this.checked;
        // 获取所有 name=select 并且不带有 disabled 属性的勾选框
        document.querySelectorAll('input[name="select"][type="checkbox"]:not([disabled])').forEach(function(checkbox) {
          // 将其勾选状态设为与目标单选框一致
          checkbox.checked = checked;
        });
      });
    });
  </script>

@endsection
