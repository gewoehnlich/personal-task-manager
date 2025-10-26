import { Bill } from '@/interfaces/bill';
import { Stage } from '@/types/stage';

export interface Task {
    id: number;
    userId: number;
    parentId: number;
    title: string;
    description: string;
    stage: Stage;
    deleted: bool;
    deadline: Date;
    createdAt: Date;
    updatedAt: Date;
    bills: Bill[];
}
