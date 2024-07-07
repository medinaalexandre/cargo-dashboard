import Api from '@/infra/api';
import { AxiosResponse } from 'axios';
import {
    ContainerListRequest,
    ContainerListResponse,
    DashboardDataResponse,
    DashboardRequest,
    OriginAndDestinationsOptions,
} from '@/entities/Containers.types';

class ContainerEntity {
    cleanParams = (params: any) =>
        Object.fromEntries(
            Object.entries(params).filter(
                ([, v]) => v !== null && v !== undefined && v !== ''
            )
        );

    list = async (filters: ContainerListRequest) => {
        return await Api.get('/container', {
            params: this.cleanParams(filters),
        }).then((res: AxiosResponse<ContainerListResponse>) => res.data);
    };

    dashboardData = async (filters: DashboardRequest) => {
        return await Api.get('/dashboard', {
            params: this.cleanParams(filters),
        }).then((res: AxiosResponse<DashboardDataResponse>) => res.data);
    };

    originAndDestinationsOptions = async () => {
        return await Api.get('/filters/options').then(
            (res: AxiosResponse<OriginAndDestinationsOptions>) => res.data
        );
    };
}

export const Container: ContainerEntity = new ContainerEntity();
