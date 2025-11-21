import { cva, type VariantProps } from 'class-variance-authority'

export { default as Button } from './Button.vue'

export const buttonVariants = cva(
  'whitespace-nowrap text-sm font-medium',
  {
    variants: {
      variant: {
        confirmative:
            'bg-confirmative/60 hover:bg-confirmative',
        destructive:
            'bg-destructive/60 shadow-xs hover:bg-destructive',
        kanban:
            '',
        cancel:
            'bg-muted hover:bg-muted-foreground/30',
      },
      size: {
        default: 'h-9 px-4 py-2 has-[>svg]:px-3',
        sm: 'h-8 rounded-2xl gap-1.5 px-3 has-[>svg]:px-2.5',
        lg: 'h-10 rounded-2xl px-6 has-[>svg]:px-4',
        icon: 'size-9',
      },
    },
    defaultVariants: {
      variant: 'kanban',
      size: 'default',
    },
  },
)

export type ButtonVariants = VariantProps<typeof buttonVariants>
