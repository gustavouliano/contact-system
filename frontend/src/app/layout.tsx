import type { Metadata } from "next";
import "bootstrap/dist/css/bootstrap.min.css";
import "./globals.css";
import Link from "next/link";

export const metadata: Metadata = {
  title: "Sistema de contatos",
  description: "Contact system app",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="pt-BR">
      <body>
        <Link href="/" className="m-4">
          Voltar para o Início
        </Link>
        {children}
      </body>
    </html>
  );
}
