export type Task = {
    uuid: string;
    user_uuid: string;
    title: string;
    description?: string | null;
    stage: string;
    deadline?: string | null;
    created_at: string;
    updated_at: string;
    deleted_at: string;
    project_uuid?: string;
    bills?: Bill[];
}
