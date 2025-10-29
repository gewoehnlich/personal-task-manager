export interface Bill {
    id: number;
    taskId: number;
    description: string;
    timeSpent: number;
    deleted: boolean;
    performedAt: Date;
    createdAt: Date;
    updatedAt: Date;
}
