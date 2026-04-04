import { Bill } from '@/interfaces/bill';
import { Stage } from '@/types/stage';

export interface Task {
    uuid: string;
    user_uuid: string;
    title: string;
    description: string;
    stage: Stage;
    deadline: Date;
    created_at: Date;
    updated_at: Date;
    deleted_at: Date;
    bills: Bill[];
}
