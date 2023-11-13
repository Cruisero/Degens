<template>
  <div>
    <!-- 其他组件内容 -->
        <input type="hidden" name="province" v-model="address.province">
        <input type="hidden" name="city" v-model="address.city">
        <input type="hidden" name="district" v-model="address.district">
    <!-- 引入SelectDistrict.vue组件 -->
    <select-district :initial-address="initialAddress" @change="handleDistrictChange"></select-district>
  </div>
</template>

<script >
// UserAddressesCreateAndEdit.vue

import { ref, reactive } from 'vue'
import SelectDistrict from './SelectDistrict.vue'


export default {
  components: {
    SelectDistrict
  },


  props: {
    initialAddress: Object,

  },


    setup(){
    // console.log(initialAddress); // 打印初始地址看是否正确

    const address = reactive({
      province: '',
      city: '',
      district: ''
    })

    // const updateAddress = (val) => {
    //     address.province = val.province;
    //     address.city = val.city;
    //     address.district = val.district;

    // }
    const handleDistrictChange = (val) => {
        // updateAddress(data);
        // console.log('handleDistrictChange called', data);
        if (val && val.length === 3) {
        address.province = val[0];
        address.city = val[1];
        address.district = val[2];
      }

    };

    // const initValue = ref([
    //     // updateAddress.province
    //     ]);
    //     console.log(initValue.value)

    return {
      address,
    //   updateAddress,
      handleDistrictChange


  }
    }
}


</script>

