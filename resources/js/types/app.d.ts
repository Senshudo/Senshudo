declare namespace App {
    export type Article = {
        id: number;
        categories?: Category[];
        author?: Author;
        event?: Event;
        review?: Review;
        title: string;
        slug: string;
        thumbnail?: Media | null;
        socialThumbnail?: Media | null;
        background?: Media | null;
        excerpt: string;
        content: string;
        keywords: string;
        sources: { name: string; url: string }[] | null;
        is_featured: boolean;
        published_at: string;
        created_at: string;
        updated_at: string;
    }

    export type Author = {
        id: number;
        name: string;
        slug: string;
        is_active: boolean;
        position: string;
        twitter: string | null;
        articles?: Article[] | PageResource<Article>;
        article_count?: number;
        avatar: string | null;
        created_at: string;
        updated_at: string;
    }

    export type Category = {
        id: number;
        name: string;
        slug: string;
        is_parent: boolean;
        parent?: Category;
        children?: Category[];
        articles?: Article[] | PageResource<Article>;
        article_count?: number;
        created_at: string;
        updated_at: string;
    }

    export type Channel = {
        id: number;
        twitch_id: string;
        channel_name: string;
        is_online: boolean;
        created_at: string;
        updated_at: string;
    }

    export type Event = {
        id: number;
        name: string;
        slug: string;
        hashtag: string | null;
        website: string | null;
        description: string;
        keywords: string | null;
        start_date: string;
        end_date: string;
        articles?: Article[] | PageResource<Article>;
        created_at: string;
        updated_at: string;
    }

    export type Media = {
        uuid: string;
        name: string;
        size: number;
        mime_type: string | null;
        collection_name: string;
        human_size: string;
        url: string;
        conversions: { name: string; url: string }[];
        path: string;
        created_at: string;
    }

    export type PageResource<T> = {
        data: T[];
        meta: PageMeta;
    }

    export type PageMeta = {
        current_page: number;
        from: number;
        last_page: number;
        per_page: number;
        to: number;
        total: number;
        path: string;
        links: {
          [key: number]: { url: string | null; label: string; active: boolean };
        }
    }

    export type Review = {
        id: number;
        article?: Article;
        oneliner: string;
        quote: string;
        overall: number;
        graphics: number;
        gameplay: number;
        sound: number;
        story: number;
        created_at: string;
        updated_at: string;
    }

    export type SharedData = {
        env: string;
        app_url: string;
        amp_url: string;
        isWebpSupported: boolean;
        location: string;
        route: string | null;
    }
}
