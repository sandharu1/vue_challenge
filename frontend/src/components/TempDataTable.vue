<template>
  <div>
    <div class="row">
      <div class="col-sm-10"></div>
      <div class="col-sm-1">
        <button
          type="button"
          class="btn btn-sm btn-primary mb-4"
          @click="sortTempDataBy('created_at')"
        >
          Reset Order
        </button>
      </div>
      <div class="col-sm-1">
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
