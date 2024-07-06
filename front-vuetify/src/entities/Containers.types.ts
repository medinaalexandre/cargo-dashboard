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

export interface ContainerListRequest {
    page?: number;
    per_page?: number;
}
