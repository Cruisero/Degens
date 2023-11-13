<template>
  <div>
    <!-- 其他组件内容 -->
        <input type="hidden" name="province" v-model="address.province">
        <input type="hidden" name="city" v-model="address.city">
        <input type="hidden" name="district" v-model="address.district">
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
        address.province = val.province;
        address.city = val.city;
        address.district = val.district;

    }
    const handleDistrictChange = (data) => {
        updateAddress(data);

    };

    return {
      address,
      updateAddress,
      handleDistrictChange


  }
    }
}


</script>

