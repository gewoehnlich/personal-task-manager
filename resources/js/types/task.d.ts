export type Task = {
    uuid: string;
    user_uuid: string;
    title: string;
    description?: string;
    stage: string;
    deadline?: string;
    created_at?: string;
    updated_at?: string;
    deleted_at?: string;
    project_uuid?: string;
    bills?: Bill[];
}
