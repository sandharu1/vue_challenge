<template>
  <div>
    <div class="row">
      <div class="col-sm-8"></div>
      <div class="col-sm-2">
        <button
          type="button"
          class="btn btn-sm btn-primary mb-4"
          @click="sortTempDataBy('created_at')"
        >
          Reset Order
        </button>
      </div>
      <div class="col-sm-2">
        <button
          type="button"
          class="btn btn-sm btn-danger mb-4"
          @click="sortTempDataBy('temp_c')"
        >
          Hottest First
        </button>
      </div>
    </div>
    <div class="row">
      <!-- Two columns -->
      <div
        v-for="(city, index) in cities"
        :key="index"
        class="col-sm-6 table-responsive-sm"
      >
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th class="">{{ city.name }}</th>
              <th class=""></th>
              <th class=""></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="city_temp in city_temps[city.slug]" :key="city_temp.id">
              <td class="">
                {{ formatTimestamp(city_temp.created_at) }}
              </td>
              <td class="">{{ city_temp.temp_c }} &#8451;</td>
              <td class="">{{ city_temp.temp_f }} &#8457;</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div>
          <pagination :pagination="pagination" @paginate="paginatedData" :offset="4" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Pagination from "@/Components/DataTablePagination.vue";
import useCityTemp from "../composables/city_temperatures";
import { onMounted } from "vue";

export default {
  components: {
    pagination: Pagination,
  },
  setup() {
    const {
      errors,
      cities,
      pagination,
      city_temps,
      offset,
      sortBy,
      fetchCities,
      fetchTempData,
      paginatedData,
      sortTempDataBy,
      formatTimestamp,
    } = useCityTemp();

    onMounted(fetchCities);

    return {
      errors,
      cities,
      pagination,
      city_temps,
      offset,
      sortBy,
      formatTimestamp,
      sortTempDataBy,
      paginatedData,
    };
  },
};
</script>
