export type Bill = {
    uuid: string;
    task_uuid: string;
    description: string;
    minutes_spent?: number;
    performed_at?: Date;
    created_at?: Date;
    updated_at?: Date;
    deleted_at?: Date;
}
