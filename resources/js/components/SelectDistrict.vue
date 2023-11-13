
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
  import { ref, watch,defineProps } from 'vue';
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


