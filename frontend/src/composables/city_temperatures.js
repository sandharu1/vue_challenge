import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import moment from "moment";

export default function useCityTemp() {
    const cities = ref({})
    const pagination = ref({})
    const city_temps = ref({})
    const offset = ref(4)
    const sortBy = ref("created_at")

    const errors = ref('')
    const router = useRouter()

    const fetchCities = async () => {
        let response = await axios.get('/api/v1/city_temp/fetch_cities')
        cities.value = response.data.data;
        cities.value.forEach((element) => {
            fetchTempData(element.slug, "created_at");
        });
    }

    const fetchTempData = async (city_slug, sort_by, pageNum) => {
        let response = await axios.get(`/api/v1/city_temp/fetch_temperatures?city_slug=${city_slug}&sort_by=${sort_by}&page=${pageNum}`)
        pagination.value = response.data.pagination;
        city_temps[city_slug] = response.data.cityTempData;

    }

    const paginatedData = function () {
        cities.value.forEach((element) => {
            fetchTempData(element.slug, this.sortBy);
        });
    }

    const sortTempDataBy = function (sort_by) {
        // reset pagination
        pagination.value.current_page = 1;
        //update sort by value
        sortBy.value = sort_by;
        // fetch sorted data by city
        cities.value.forEach((element) => {
            fetchTempData(element.slug, sort_by);
        });
    }

    const formatTimestamp = function (value) {
        return moment(value).format("ddd, DD MMMM YYYY, h:mm a");
    }


    return {
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
        formatTimestamp
    }
}