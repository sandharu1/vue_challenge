<template>
  <div class="md:container md:mx-auto">
    <div class="row">
      <div class="flex">
        <div>
          <button
            type="button"
            class="btn btn-sm btn-primary mb-4"
            @click="sortTempDataBy('created_at')"
          >
            Reset Order
          </button>
        </div>
        <div>
          <button
            type="button"
            class="btn btn-sm btn-danger mb-4"
            @click="sortTempDataBy('temp_c')"
          >
            Hottest First
          </button>
        </div>
      </div>
    </div>
    <div class="row-auto">
      <!-- Two columns -->
      <div class="flex flex-wrap lg:flex-row">
        <div
          v-for="(city, index) in cities"
          :key="index"
          class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/2 mb-4"
        >
          <table class="shadow-lg bg-white border-collapse table-auto">
            <tr>
              <th class="bg-blue-100 border text-left px-8 py-4">{{ city.name }}</th>
              <th class="bg-blue-100 border text-left px-8 py-4"></th>
              <th class="bg-blue-100 border text-left px-8 py-4"></th>
            </tr>
            <tr v-for="city_temp in city_temps[city.slug]" :key="city_temp.id">
              <td class="border px-8 py-4">
                {{ formatTimestamp(city_temp.created_at) }}
              </td>
              <td class="border px-8 py-4">{{ city_temp.temp_c }} &#8451;</td>
              <td class="border px-8 py-4">{{ city_temp.temp_f }} &#8457;</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row-auto">
    <div class="flex flex-row-reverse space-x-4 space-x-reverse my-4">
      <div>
        <pagination :pagination="pagination" @paginate="paginatedData" :offset="4" />
      </div>
    </div>
  </div>
</template>

<script>
import Pagination from "@/Components/DataTablePagination.vue";
import axios from "axios";
import moment from "moment";

export default {
  data() {
    return {
      cities: {},
      offset: 4,
      pagination: {},
      city_temps: {},
      sortBy: "created_at",
    };
  },
  components: {
    pagination: Pagination,
  },
  mounted() {
    this.fetchCities();
  },
  methods: {
    fetchTempData: function (city_slug, sort_by) {
      let current_page = this.pagination.current_page;
      let pageNum = current_page ? current_page : 1;

      axios
        .get(
          `/api/v1/city_temp/fetch_temperatures?city_slug=${city_slug}&sort_by=${sort_by}&page=${pageNum}`
        )
        .then((result) => {
          this.pagination = result.data.pagination;
          this.city_temps[city_slug] = result.data.cityTempData;
        })
        .catch((err) => {
          console.error();
        });
    },
    fetchCities() {
      axios
        .get(`/api/v1/city_temp/fetch_cities`)
        .then((result) => {
          this.cities = result.data.data;
          this.cities.forEach((element) => {
            this.fetchTempData(element.slug, "created_at");
          });
        })
        .catch((err) => {
          console.error();
        });
    },
    paginatedData: function () {
      this.cities.forEach((element) => {
        this.fetchTempData(element.slug, this.sortBy);
      });
    },
    sortTempDataBy: function (sort_by) {
      // reset pagination
      this.pagination.current_page = 1;
      //update sort by value
      this.sortBy = sort_by;
      // fetch sorted data by city
      this.cities.forEach((element) => {
        this.fetchTempData(element.slug, sort_by);
      });
    },
    formatTimestamp: function (value) {
      return moment(value).format("ddd, DD MMMM YYYY, h:mm a");
    },
  },
  created() {},
};
</script>
