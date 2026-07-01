export type Task = {
    uuid: string;
    user_uuid: string;
    title: string;
    description?: string;
    stage: Stage;
    deadline?: Date;
    created_at?: Date;
    updated_at?: Date;
    deleted_at?: Date;
    project_uuid?: string;
    bills?: Bill[];
}
