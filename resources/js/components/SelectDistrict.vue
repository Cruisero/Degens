
<template>
    <div class="form-group row">

      <label class="col-form-label col-sm-2 text-md-right">省市区</label>
      <div class="col-sm-3">
        <select class="form-control" v-model="provinceId " @change="handleDistrictChange">
          <option value="">选择省</option>
          <option v-for="(name, id) in provinces" :value="id" :key="id">{{ name }}</option>
        </select>
      </div>
      <div class="col-sm-3">
        <select class="form-control" v-model="cityId" @change="handleDistrictChange">
          <option value="">选择市</option>
          <option v-for="(name, id) in cities" :value="id" :key="id">{{ name }}</option>
        </select>
      </div>
      <div class="col-sm-3">
        <select class="form-control" v-model="districtId" @change="handleDistrictChange">
          <option value="">选择区</option>
          <option v-for="(name, id) in districts" :value="id" :key="id">{{ name }}</option>
        </select>
      </div>
    </div>



</template>


  <script setup>
  import { ref, watch,defineProps,onMounted } from 'vue';
  import addressData from 'china-area-data/v5/data';
  import _ from 'lodash';


  const props = defineProps({
  initialAddress: Object

});


//   const provinceId = ref('');
//   const cityId = ref('');
//   const districtId = ref('');
  const provinceId = ref(props.initialAddress ? props.initialAddress.provinceId : '');
  const cityId = ref(props.initialAddress ? props.initialAddress.cityId : '');
  const districtId = ref(props.initialAddress ? props.initialAddress.districtId : '');
  const provinces = addressData['86'];
  const cities = ref('');
  const districts = ref('');
  const emit = defineEmits();

  onMounted(() => {
  if (props.initialAddress && props.initialAddress.length === 3) {
    // 查找省份ID
    const provinceName = props.initialAddress[0];
    const provinceIdFound = Object.keys(addressData['86']).find(id => addressData['86'][id] === provinceName);
    if (provinceIdFound) {
      provinceId.value = provinceIdFound;
      cities.value = addressData[provinceIdFound];
    }

    // 如果省份ID找到，继续查找城市ID
    if (provinceId.value) {
      const cityName = props.initialAddress[1];
      const cityIdFound = Object.keys(addressData[provinceId.value]).find(id => addressData[provinceId.value][id] === cityName);
      if (cityIdFound) {
        cityId.value = cityIdFound;
        districts.value = addressData[cityIdFound];
      }

      // 如果城市ID找到，继续查找区域ID
      if (cityId.value) {
        const districtName = props.initialAddress[2];
        const districtIdFound = Object.keys(addressData[cityId.value]).find(id => addressData[cityId.value][id] === districtName);
        if (districtIdFound) {
          districtId.value = districtIdFound;
        }
      }
    }
  }
});




    // 当省、市、区的选择改变时，发出事件
    watch(provinceId, () => emitUpdate());
    watch(cityId, () => emitUpdate());
    watch(districtId, () => emitUpdate());

    function emitUpdate() {
        emit('update', {
            province: provinces[provinceId.value],
            city: cities.value[cityId.value],
            district: districts.value[districtId.value]
        });
        }
    watch(provinceId, (newVal) => {
        if (!newVal) {
        cities.value = {};
        cityId.value = '';
        return;
        }
        cities.value = addressData[newVal];
        if (!cities.value[cityId.value]) {
        cityId.value = '';
        }
    });

    watch(cityId, (newVal) => {
        if (!newVal) {
        districts.value = {};
        districtId.value = '';
        return;
        }
        districts.value = addressData[newVal];
        if (!districts.value[districtId.value]) {
        districtId.value = '';
        }
    });

    watch(districtId, () => {
        emit('change', [provinces[provinceId.value], cities.value[cityId.value], districts.value[districtId.value]]);
    });



  </script>


