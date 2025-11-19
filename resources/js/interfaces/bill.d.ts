export interface Bill {
    id: number;
    task_id: number;
    description: string;
    time_spent: number;
    deleted: boolean;
    performed_at: Date;
    created_at: Date;
    updated_at: Date;
}
