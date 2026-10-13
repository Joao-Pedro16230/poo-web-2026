
import { api } from "@/boot/axios"

export const getCustomers = (params = {}) => {
    return api.get('/customers', { params }).then(({ data }) => data)
}

export const createCustomer = (params = {}) => {
    return api.post('/customers', params).then(({ data }) => data)
}

export const getCustomer = (id) => {
    return api.get(`/customers/${id}`).then(({ data }) => data)
}

export const updateCustomer = (id, params = {}) => {
    return api.put(`/customers/${id}`, params).then(({ data }) => data)
}

export const deleteCustomer = (id) => {
    return api.delete(`/customers/${id}`).then(({ data }) => data)
}
