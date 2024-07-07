export interface Container {
    id: number;
    label: string;
    company: string;
    inspection_status: string;
    packing_list: string;
    items_count: number;
    arrival_at: string;
    departure_at?: string;
    weight: number;
    origin: string;
    destination: string;
    capacity: number;
    contents_price_cents: number;
    created_at: string;
    updated_at: string;
}

export interface ContainerListResponse {
    data: Container[];
    current_page: number;
    per_page: number;
    total: number;
}

interface LocationCount {
    location: string;
    count: number;
}

interface CompanyContainerAvgDay {
    company: string;
    avgDay: number;
}

interface UsageHistory {
    date: string;
    usage: number;
}

export interface DashboardDataResponse {
    stopped_containers: number;
    contents_price: string;
    usage_percentage: number;
    destinations: Array<LocationCount>;
    origins: Array<LocationCount>;
    companies_container_avg_day: Array<CompanyContainerAvgDay>;
    usage_history: Array<UsageHistory>;
}

export interface ContainerListRequest extends DashboardRequest {
    page?: number;
    per_page?: number;
}

export interface DashboardRequest {}

export interface OriginAndDestinationsOptions {
    origin: Array<string>;
    destination: Array<string>;
}
