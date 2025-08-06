// 1. Ganti import layout sesuai dengan yang Anda temukan
import AppLayout from '@/layouts/app-layout';
import { Head } from '@inertiajs/react';
import { PageProps } from '@/types';

// Tipe untuk data artikel (tidak berubah)
type Article = {
    id: number;
    title: string;
    content: string;
    created_at: string;
    updated_at: string;
};

// Tipe untuk props halaman (tidak berubah)
type ArticlesPageProps = PageProps & {
    articles: Article[];
};

export default function Index({ auth, articles }: ArticlesPageProps) {
    return (
        // 2. Gunakan AppLayout dan HAPUS prop 'user'
        <AppLayout>
            <Head title="Articles" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            You have access to <span className="font-bold">{articles.length}</span> articles.
                        </div>
                    </div>

                    <div className="mt-6 grid gap-6 lg:grid-cols-3 md:grid-cols-2">
                        {articles.map((article) => (
                            <div key={article.id} className="bg-white p-6 shadow-sm rounded-lg flex flex-col">
                                <h3 className="text-lg font-bold text-gray-900 mb-2">
                                    {article.title}
                                </h3>
                                <p className="text-gray-600 text-sm flex-grow">
                                    {article.content.substring(0, 150)}...
                                </p>
                                <p className="text-xs text-gray-400 mt-4">
                                    Published on: {new Date(article.created_at).toLocaleDateString()}
                                </p>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
