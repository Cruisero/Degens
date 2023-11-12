<template>
  <div>
    <!-- 其他组件内容 -->

    <!-- 引入SelectDistrict.vue组件 -->
    <select-district></select-district>
  </div>
</template>

<script>
// UserAddressesCreateAndEdit.vue

import { ref, reactive } from 'vue'
import SelectDistrict from './SelectDistrict.vue'


export default {
  components: {
    SelectDistrict
  },

  setup() {
    const address = reactive({
      province: '',
      city: '',
      district: ''
    })

    const updateAddress = (val) => {
      // validate and update address
      address.province = data.province

    }

    return {
      address,
      updateAddress,

    //   province: address.province,
    //   city: address.city,
    //   district: address.district
    }
  }
}
</script>
