import { Bill } from '@/interfaces/bill';
import { Stage } from '@/types/stage';

export interface Task {
    id: number;
    user_id: number;
    parent_id: number;
    title: string;
    description: string;
    stage: Stage;
    deadline: Date;
    created_at: Date;
    updated_at: Date;
    bills: Bill[];
}
