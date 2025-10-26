export interface Bill {
    id: number;
    taskId: number;
    description: string;
    timeSpent: number;
    deleted: bool;
    performedAt: Date;
    createdAt: Date;
    updatedAt: Date;
}
