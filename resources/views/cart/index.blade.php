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
    <div>
        <form class="form-horizontal" role="form" id="order-form">
          <div class="form-group row">
            <label class="col-form-label col-sm-3 text-md-right">选择收货地址</label>
            <div class="col-sm-9 col-md-7">
              <select class="form-control" name="address">
                @foreach($addresses as $address)
                  <option value="{{ $address->id }}">{{ $address->full_address }} {{ $address->contact_name }} {{ $address->contact_phone }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row mt-2">
            <label class="col-form-label col-sm-3 text-md-right">备注</label>
            <div class="col-sm-9 col-md-7">
              <textarea name="remark" class="form-control" rows="3"></textarea>
            </div>
          </div>
          <div class="form-group mt-2 ms-lg-2">
            <div class="offset-sm-3 col-sm-3">
              <button type="button" class="btn btn-primary btn-create-order">提交订单</button>
            </div>
          </div>
        </form>
      </div>
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


    // 监听创建订单按钮的点击事件
    document.querySelectorAll('.btn-create-order').forEach(function(button) {
      button.addEventListener('click', function() {
        // 构建请求参数
        var addressSelect = document.querySelector('#order-form select[name="address"]');
        var remarkTextarea = document.querySelector('#order-form textarea[name="remark"]');
        var req = {
          address_id: addressSelect ? addressSelect.value : null,
          items: [],
          remark: remarkTextarea ? remarkTextarea.value : '',
        };

        // 遍历每个购物车中的商品 SKU
        document.querySelectorAll('table tr[data-id]').forEach(function(row) {
          var checkbox = row.querySelector('input[name="select"][type="checkbox"]');
          var input = row.querySelector('input[name="amount"]');

          if (checkbox && !checkbox.disabled && checkbox.checked) {
            if (input && input.value != 0 && !isNaN(input.value)) {
              req.items.push({
                sku_id: row.getAttribute('data-id'),
                amount: input.value,
              });
            }
          }
        });

        // 发送请求
        axios.post('{{ route('orders.store') }}', req)
          .then(function(response) {
            Swal.fire('订单提交成功', '', 'success')
            .then(() => {
            location.href = '/orders/' + response.data.id;
            });
          })
          .catch(function(error) {
            if (error.response && error.response.status === 422) {
              // 用户输入校验失败
              var html = '<div>';
              Object.values(error.response.data.errors).forEach(function(errors) {
                errors.forEach(function(error) {
                  html += error + '<br>';
                });
              });
              html += '</div>';
              Swal.fire({html: html, icon: 'error'});
            } else {
              // 系统错误
              Swal.fire('系统错误', '', 'error');
            }
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
