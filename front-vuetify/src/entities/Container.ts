import Api from '@/infra/api';
import { AxiosResponse } from 'axios';
import {
    ContainerListRequest,
    ContainerListResponse,
} from '@/entities/Containers.types';

class ContainerEntity {
    list = async (filters: ContainerListRequest) => {
        return await Api.get('/container', {
            params: filters,
        }).then((res: AxiosResponse<ContainerListResponse>) => res.data);
    };
}

export const Container: ContainerEntity = new ContainerEntity();
