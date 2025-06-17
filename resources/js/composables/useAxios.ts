import axios, { Axios } from 'axios'
import merge from 'lodash/merge'

export default (): Axios => {
    const axiosService = axios.create({
        baseURL:
            usePage().props.env === 'local'
                ? 'http://localhost:8000/api'
                : usePage().props.env === 'production'
                  ? 'https://senshudo.tv/api'
                  : 'https://staging.senshudo.tv/api',
        withCredentials: true,
        headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
    })

    axiosService.interceptors.request.use(
        (config) => merge({}, config),
        (error) => Promise.reject(error),
    )

    axiosService.interceptors.response.use(
        (response) =>
            response.data?.meta ? response.data : (response?.data?.data ?? response.data),
        (error) => Promise.reject(error),
    )

    return axiosService
}
