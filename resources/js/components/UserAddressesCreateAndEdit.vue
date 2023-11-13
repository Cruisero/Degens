<template>
  <div>
    <!-- 其他组件内容 -->

    <!-- 引入SelectDistrict.vue组件 -->
    <select-district @update="handleDistrictChange"></select-district>
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

    setup(){
    const address = reactive({
      province: '',
      city: '',
      district: ''
    })

    const updateAddress = (val) => {
      // validate and update address
      address.province = data.province

    }
    const handleDistrictChange = (data) => {
    address.province = data.province;
    address.city = data.city;
    address.district = data.district;
    // console.log('Updated address:', address);
    };

    return {
      address,
      updateAddress,
      handleDistrictChange

    //   province: address.province,
    //   city: address.city,
    //   district: address.district

  }
    }
}


</script>
