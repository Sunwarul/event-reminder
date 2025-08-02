import { clsx, type ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';
import { openDB } from 'idb';

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

