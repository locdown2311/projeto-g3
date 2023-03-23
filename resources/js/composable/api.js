import axios from 'axios';

export function getUsers() {
    return axios.get('/api/users');
}

export function getColor(id) {
    return axios.get(`/projetos/busca/${id}`);
}