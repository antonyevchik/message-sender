export interface User {
    id: number
    name: string
    email: string
}

export interface Message {
    id: number
    sender: User
    recipient: User
}

export interface PaginationLink {
    url: string | null
    label: string
    active: boolean
}

export interface PaginationMeta {
    current_page: number
    last_page: number
    per_page: number
    total: number
}

export interface MessageResponse {
  data: Message[]
  links: PaginationLink[]
  meta: PaginationMeta
}
