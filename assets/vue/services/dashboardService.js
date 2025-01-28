import axios from "axios";

export function fetchDashboardData() {
    return axios.get("/api/user/dashboard");
}